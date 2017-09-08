sub vcl_recv {
    set req.http.Surrogate-Capability = "abc=ESI/1.0";

    if (req.restarts == 0) {
        if (req.http.x-forwarded-for) {
            set req.http.X-Forwarded-For =
            req.http.X-Forwarded-For + ", " + client.ip;
        } else {
            set req.http.X-Forwarded-For = client.ip;
        }
    }

    if (req.request != "GET" &&
        req.request != "HEAD" &&
        req.request != "PUT" &&
        req.request != "POST" &&
        req.request != "TRACE" &&
        req.request != "OPTIONS" &&
        req.request != "DELETE") {
            /* Non-RFC2616 or CONNECT which is weird. */
            return (pipe);
        }

    if (req.request != "GET" && req.request != "HEAD") {
        /* We only deal with GET and HEAD by default */
        return (pass);
    }

    if (req.http.Authorization || req.http.Cookie) {
        /* Not cacheable by default */
        #return (pass);
    }

    return (lookup);
}


sub vcl_hash {
    ### these 2 entries are the default ones used for vcl. Below we add our own.
    hash_data(req.url);
    hash_data(req.http.host);

    if( req.http.Cookie ~ "locale" ) {
        hash_data(regsub( req.http.Cookie, "^.*?locale=([^;]*);*.*$", "\1" ));
    }

    return (hash);
}
if( req.http.Cookie ~ "locale" ) {
        hash_data(regsub( req.http.Cookie, "^.*?locale=([^;]*);*.*$", "\1" ));
}

sub vcl_fetch {
    if (beresp.http.surrogate-control ~ "ESI/1.0") {
        unset beresp.http.surrogate-control;
        set beresp.do_esi = true;
    }

    if (beresp.ttl <= 0s ||
        beresp.http.Set-Cookie ||
        beresp.http.Vary == "*") {
        /*
        * Mark as "Hit-For-Pass" for the next 2 minutes
        */
        set beresp.ttl = 120 s;
        return (hit_for_pass);
    }

    return (deliver);
}