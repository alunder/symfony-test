FROM debian:buster

ENV DEBIAN_FRONTEND noninteractive
WORKDIR /var/www/symfony

SHELL ["/bin/bash", "-l", "-euxo", "pipefail", "-c"]

RUN apt-get update && apt-get install -y gnupg2 libgl1-mesa-glx libxi6 libgconf-2-4

RUN apt-get update; \
    apt-get full-upgrade -y; \
    apt-get install -y --no-install-recommends \
        ca-certificates \
        curl \
    ; \
    apt-get clean; \
    rm -rf /var/lib/apt/lists/*

ENV NVM_DIR /usr/local/nvm

RUN mkdir -p "$NVM_DIR"; \
    curl -o- \
        "https://raw.githubusercontent.com/nvm-sh/nvm/master/install.sh" | \
        bash \
    ; \
    source $NVM_DIR/nvm.sh; \
    nvm install --lts --latest-npm

RUN command -v nvm; \
    command -v node; \
    node --version; \
    command -v npm; \
    npm --version

# Add Yarn as PPA
RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -
RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list
RUN apt-get -qq update

# Intall Yarn
RUN apt-get install -y -qq yarn

RUN npm install --global gulp-cli
RUN npm install -g gulp