FROM node:16-alpine as node
FROM nginx:alpine

RUN apk update \
  && apk add --update --no-cache --virtual=.build-dependencies g++ \
  && apk add bash

WORKDIR /var/www/html
# node, npm, yarn
COPY --from=node /usr/local/bin/node /usr/local/bin/
COPY --from=node /usr/local/lib/node_modules/ /usr/local/lib/node_modules/
RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm
COPY --from=node /opt/yarn-* /opt/yarn
RUN ln -fs /opt/yarn/bin/yarn /usr/local/bin/yarn
