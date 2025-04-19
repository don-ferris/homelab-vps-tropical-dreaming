# TROPICAL-DREAMING (BLUDIT BLOG)
**Container**: tropical-dreaming  
**Server**: VPS  
**Host Path**: `/root/docker/tropical-dreaming`

---

### [▶️](https://github.com/ikatyang/emoji-cheat-sheet/blob/master/README.md)  Overview

[Tropical Dreaming - Krista & Donnie's Panama Expat Travel Blog](https://TropicalDreaming.TikiShack.com/) Our Panama travel blog

---

### [⚙️](https://github.com/ikatyang/emoji-cheat-sheet/blob/master/README.md)  Docker Configuration

| Key          | Value                |
|--------------|----------------------|
| Dockerized?  | Yes (docker-compose) |
| Compose File | [`docker-compose.yml`](./docker-compose.yml) |
| Env File     | [`.env`](./.env) |
| Bind Mounts  | `./data` → `/data`  |

---

### [:key:](https://github.com/ikatyang/emoji-cheat-sheet/blob/master/README.md)  Access

| Access Type     | Value / URL                             |
|------------------|------------------------------------------|
| Public Hostname  | [TropicalDreaming.TikiShack.com](https://TropicalDreaming.TikiShack.com) *(via [Cloudflare Tunnel](https://one.dash.cloudflare.com/0889c842407ffe50bd89d900e389f5b7/networks/tunnels/7f2310e1-5350-4ab6-9c94-bb92159f1851/public-hostname/tropicaldreaming.tikishack.com/6))* |
| VPS IP:PORT         | [107.172.201.30:8084](http://107.172.201.30:8084) |
| Auth Required?   | Yes |
| Admin Username   | donnybahama@gmail.com |
| Password (1)     | bxpd efvs riyd dduy |
| Username (1)     | Donnie |
| Password (1)     | X6h6F5A^7pe7kU7ozPASSWORD_1n!hajF |
| Username (2)     | krista |
| Password (2)     | z6L9X*Ko*$gg4$^DtzjPASSWORD_2PASSWORD_237E |

---

### [☁️](https://github.com/ikatyang/emoji-cheat-sheet/blob/master/README.md)  Cloudflare Tunnel

- **Tunnel Name**: `VPS`
- **Ingress Rule** (Caddy/Cloudflare config): N/A (_deferred_)

---

### [📎](https://github.com/ikatyang/emoji-cheat-sheet/blob/master/README.md)  Notes & Customizations
- Any volumes, plugins, CLI overrides
- Any upgrade instructions
- App-specific tweaks

---

### [:books:](https://github.com/ikatyang/emoji-cheat-sheet/blob/master/README.md)  References
- [Official Docs](https://docs.bludit.com/en)
- [Support URL](https://forum.bludit.org/)
- [Reddit](https://www.reddit.com/r/bludit)
- [Google Search](https://www.google.com/search?q=bludit)
- [Dokuwiki link](https://labdocs.donferris.me/blog-tropical_dreaming)

---

### [💾](https://github.com/ikatyang/emoji-cheat-sheet/blob/master/README.md)  Backup & Restore

#### Backup
- Backup archives stored in BACKUP/
- To create a new backup:
```bash
tar -czf BACKUP/TROPICAL-DREAMING-$(date +'%Y-%m-%d').tar.gz ./data
```
- Commit & push to GitHub to version it
```bash
git add . && git commit -m "Backup on $(date +'%Y-%m-%d') " && git push
```
#### Restore
1.	Clone the repo
2.	Extract the desired archive to ./data:
```bash	
tar -xzf BACKUP/TROPICAL-DREAMING-[backup_date].tar.gz -C ./data
```
3. Recreate the container:
```bash
docker compose up -d
```

---

## [🛠️](https://github.com/ikatyang/emoji-cheat-sheet/blob/master/README.md)  Useful Commands
### Docker
#### Start Docker container
```bash
docker compose up -d
```
#### View Docker logs
```bash
docker compose logs -f
```
#### Open shell inside Docker container
```bash
docker exec -it tropical-dreaming /bin/Backup on $(date +'%Y-%m-%d')sh
```
### Git
#### Git - Stage + Commit + Push Changes
```bash
git add . && git commit -m "Tweaks/Minor refinements - $(date +'%Y-%m-%d')" && git push
``` 
#### Git - View Current Status
```bash
git status
```
#### Git - Pull Latest Changes
```bash
git pull
```
#### Git - View Commit History (compact)
```bash
git log --oneline --graph --decorate --all
```
#### Git - Revert the Most Recent Commit (preserve changes)
```bash
git reset --soft HEAD~1
```
#### Git - Force Pull GitHub to Local— Overwrite Local
```bash
git fetch origin && git reset --hard origin/main
```
#### Git - Force Push Local to GitHub — Overwrite Remote
```bash
git push origin main --force
```
#### Git - Initial Repo Setup (one-time)
```bash
git init && \
git remote add origin git@github.com:don-ferris/repo_name.git && \
git add . && git commit -m "Initial commit" && \
git push -u origin main
```
