# Authentication & Authorization

## JSON Web Token (JWT)
- https://tools.ietf.org/html/rfc7519

## OAuth 2.0
- http://esbenp.github.io/2017/03/19/modern-rest-api-laravel-part-4/
- https://tools.ietf.org/html/rfc6749

#### Protocol Flow
```
     +--------+                               +---------------+
     |        |--(A)- Authorization Request ->|   Resource    |
     |        |                               |     Owner     |
     |        |<-(B)-- Authorization Grant ---|               |
     |        |                               +---------------+
     |        |
     |        |                               +---------------+
     |        |--(C)-- Authorization Grant -->| Authorization |
     | Client |                               |     Server    |
     |        |<-(D)----- Access Token -------|               |
     |        |                               +---------------+
     |        |
     |        |                               +---------------+
     |        |--(E)----- Access Token ------>|    Resource   |
     |        |                               |     Server    |
     |        |<-(F)--- Protected Resource ---|               |
     +--------+                               +---------------+
```
<p style="text-align: center;"><small>Figure 1: Abstract Protocol Flow</small></p>

The abstract OAuth 2.0 flow illustrated in Figure 1 describes the interaction between the four roles and includes the following steps:  
- (A)  The client requests authorization from the resource owner.  The authorization request can be made directly to the resource owner (as shown), or preferably indirectly via the authorization server as an intermediary.
- (B)  The client receives an authorization grant, which is a credential representing the resource owner's authorization, expressed using one of four grant types defined in this specification or using an extension grant type.  The authorization grant type depends on the method used by the client to request authorization and the types supported by the authorization server.
- (C)  The client requests an access token by authenticating with the authorization server and presenting the authorization grant.
- (D)  The authorization server authenticates the client and validates the authorization grant, and if valid, issues an access token.
- (E)  The client requests the protected resource from the resource server and authenticates by presenting the access token.
- (F)  The resource server validates the access token, and if valid, serves the request.

The preferred method for the client to obtain an authorization grant from the resource owner (depicted in steps (A) and (B)) is to use the authorization server as an intermediary, which is illustrated in Figure 3

```
	 +----------+
     | Resource |
     |   Owner  |
     |          |
     +----------+
          ^
          |
         (B)
     +----|-----+          Client Identifier      +---------------+
     |         -+----(A)-- & Redirection URI ---->|               |
     |  User-   |                                 | Authorization |
     |  Agent  -+----(B)-- User authenticates --->|     Server    |
     |          |                                 |               |
     |         -+----(C)-- Authorization Code ---<|               |
     +-|----|---+                                 +---------------+
       |    |                                         ^      v
      (A)  (C)                                        |      |
       |    |                                         |      |
       ^    v                                         |      |
     +---------+                                      |      |
     |         |>---(D)-- Authorization Code ---------'      |
     |  Client |          & Redirection URI                  |
     |         |                                             |
     |         |<---(E)----- Access Token -------------------'
     +---------+       (w/ Optional Refresh Token)

   Note: The lines illustrating steps (A), (B), and (C) are broken into
   two parts as they pass through the user-agent.
   ```
<p style="text-align: center;"><small>Figure 3: Authorization Code Flow</small></p>


## OAuth 1.0
- https://tools.ietf.org/html/rfc5849