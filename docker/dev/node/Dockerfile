FROM node:lts
WORKDIR /var/www/html/bedrock/web/app/themes/labeps-theme

# Préparer caches et node_modules et ownership
RUN mkdir -p var/cache/yarn node_modules \
 && chown -R node:node var/cache/yarn node_modules

USER node
RUN yarn config set cache-folder var/cache/yarn

CMD ["/bin/bash", "-c", "yarn;yarn dev"]
