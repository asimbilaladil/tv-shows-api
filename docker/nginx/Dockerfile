FROM nginx:alpine

RUN apk update \
    && apk upgrade \
    && apk add --no-cache openssl \
    && apk add --no-cache bash

ADD ./nginx-startup.sh /opt/nginx-startup.sh
RUN sed -i 's/\r//g' /opt/nginx-startup.sh
CMD ["/bin/bash", "/opt/nginx-startup.sh"]


EXPOSE 80 81 443
