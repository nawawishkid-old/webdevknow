# Docker
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