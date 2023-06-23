FROM nginx:1.21.0

ENV TZ=Europe/Paris


RUN apt-get update && apt-get install -y \
    htop \
    nano \
    cron \
    nginx-extras

EXPOSE 80 443 8080