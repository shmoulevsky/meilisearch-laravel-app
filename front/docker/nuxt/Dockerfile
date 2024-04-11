ARG NODE_VERSION=20.11.0

FROM node:${NODE_VERSION}-slim as base

ENV NODE_ENV=development

WORKDIR /front

# Build
FROM base as build

RUN npm install

# Run
FROM base

EXPOSE 3000

CMD [ "npm", "run", "dev" ]
