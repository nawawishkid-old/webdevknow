# Docker

**Update docker-compose**
run docker-compose.yml version 3 ไม่ได้ เพราะ docker-compose เราล้าสมัย ยังเป็น 1.8 อยู่ เลยอัปเดตใหม่โดยใช้ `curl` ตามที่ [docs](https://docs.docker.com/compose/install/#install-compose) บอกคือ `sudo curl -L https://github.com/docker/compose/releases/download/1.21.0/docker-compose-$(uname -s)-$(uname -m) -o /usr/local/bin/docker-compose` แล้วรอง run `docker-compose --version` ปรากฏว่ายังเป็น 1.8 เหมือนเดิม ไม่ใช่ 1.21.1  

หาทางแก้อยู่สักพักใหญ่ เลยลอง `cd` ไป `/usr/local/bin` เพื่อ run `./docker-compose --version` ปรากฏว่าไฟล์นี้ออกมาเป็น 1.21.1 แสดงว่าการติดตั้งไม่มีปัญหา แปลว่าที่ run แล้วได้ version เก่าออกมาคืออีกไฟล์นึง เราเลย run `whereis docker-compose` ได้ผลลัพธ์มา 3 ที่ 1 ใน 3 ก็คือที่เราติดตั้งไปเมื่อกี๊ อีกอันนึงจำไม่ได้ละ แต่อีกอันนึงอยู่ใน `/usr/bin/docker-compose` เลยเข้าไป run `./docker-compose --version` ผลคือ 1.8 เลยตัดสินใจย้าย `/usr/local/bin/docker-compose` ไปแทนที่ `/usr/bin/docker-compose` เท่านั้นแหละ แก้ได้ละ


Installation:
https://docs.docker.com/install/linux/docker-ce/ubuntu/#upgrade-docker-ce

Linux post installation:
https://docs.docker.com/install/linux/linux-postinstall/#configure-docker-to-start-on-boot

Rebuild image:
https://stackoverflow.com/questions/35594987/how-to-force-docker-for-clean-build-of-an-image

Remove dangling image:
docker rmi $(docker images -f dangling=true -q)
https://forums.docker.com/t/how-to-remove-none-images-after-building/7050

Install docker-machine:
https://docs.docker.com/machine/install-machine/#install-machine-directly

from: https://docs.docker.com/get-started/part4/#deploy-the-app-on-the-swarm-manager
see: https://stackoverflow.com/questions/47273235/eval-docker-machine-env-myvm1-does-not-switch-to-shell-to-talk-to-myvm1

Regenerate vm cert.
https://github.com/sparkfabrik/sparkdock/issues/14