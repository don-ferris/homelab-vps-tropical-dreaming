docker run --name tropical-dreaming -p 8084:8080 \
  -v $(pwd)/plugins:/usr/share/nginx/html/bl-plugins \
  -v $(pwd)/themes:/usr/share/nginx/html/bl-themes \
  -v $(pwd)/content:/usr/share/nginx/html/bl-content \
  -it danielsan05/bludit:latest
