# 📘 Portail Administratif Scolaire

Projet Laravel réalisé par un groupe de 3 étudiants dans le cadre de la L3 Génie Logiciel à l'ISI.

## 👥 Membres du groupe

- 👩‍💻 Ndeye Astou KOUNTA — Membre 1 (Back-end & Authentification)
- 👨‍🏫 Fatou Fall — Membre 2 (Gestion des entités académiques)
- 👨‍🎓 Lama FALL — Membre 3 (Notes, bulletins, portail parent/élève)

## 🎯 Objectif du projet

Créer une plateforme web pour la gestion des :
- Utilisateurs (admin, enseignant, élève, parent)
- Inscriptions et affectations
- Saisie des notes et bulletins PDF
- Tableaux de bord personnalisés
- Portail de consultation pour les parents et les élèves

## ⚙️ Technologies

- Laravel 11 (Blade + Breeze)
- PostgreSQL
- Tailwind CSS
- DomPDF

## 🔐 Authentification & Rôles

- `admin@ecole.com` / `password`
- `enseignant@ecole.com` / `password`
- `parent@ecole.com` / `password`
- `eleve@ecole.com` / `password`

## 🛠 Installation locale

```bash
git clone https://github.com/NdeyeAstou56/portail-scolaire2.git
cd portail-scolaire2
composer install
npm install && npm run dev
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
