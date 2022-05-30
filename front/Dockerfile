FROM node:latest

WORKDIR /app
ADD . .
RUN rm -rf node_modules
RUN npm install --dev
RUN npm ci

EXPOSE 3000

CMD ["npm", "run", "dev"]