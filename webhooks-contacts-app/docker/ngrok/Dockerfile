FROM node:18-alpine

COPY package.json /package.json
COPY yarn.lock /yarn.lock
COPY ngrok.yml /ngrok.yml
COPY index.js /index.js

RUN yarn

EXPOSE 4040

CMD ["npm", "start"]
