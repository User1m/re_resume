FROM node:9
WORKDIR /workdir/app
RUN curl -o- -L https://yarnpkg.com/install.sh | bash || true
ENV NODE_ENV development
COPY package.json /workdir/app/
# COPY bundle.js* /workdir/app/
COPY release /workdir/app/release/
COPY public /workdir/app/public/
WORKDIR /workdir/
RUN ln -s /workdir/app/package.json /workdir/package.json
RUN yarn install
ENV NODE_ENV production
ENV PATH=/workdir/node_modules/.bin/:$PATH
WORKDIR /workdir/app
ENV PORT 8082
EXPOSE 8082

# ssh
ENV SSH_PASSWD "root:Docker!"
RUN apt-get update \
    && apt-get install -y --no-install-recommends dialog \
    && apt-get update \
    && apt-get install -y --no-install-recommends openssh-server \
    && echo "$SSH_PASSWD" | chpasswd
COPY sshd_config /etc/ssh/
EXPOSE 80 3978 2222

CMD service ssh start && npm start