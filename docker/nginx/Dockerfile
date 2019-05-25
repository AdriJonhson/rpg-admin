FROM nginx:alpine

RUN apk add --no-cache openssl

RUN mkdir /etc/nginx/ssl 2> /dev/null

RUN openssl genrsa -out "/etc/nginx/ssl/app.key" 2048 \
    && openssl req -new -key "/etc/nginx/ssl/app.key" -out "/etc/nginx/ssl/app.csr" -subj "/CN=app/O=app/C=UK" \
    && openssl x509 -req -days 365 -in "/etc/nginx/ssl/app.csr" -signkey "/etc/nginx/ssl/app.key" -out "/etc/nginx/ssl/app.crt"

EXPOSE 80 443