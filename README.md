# Gestion Stock Cybersecurity

## Description

Ce projet consiste en la sécurisation d’une application web de gestion de stock développée avec Laravel et conteneurisée avec Docker.

L’objectif principal est de mettre en place une architecture sécurisée intégrant :
- Docker,
- Nginx reverse proxy,
- contrôle d’accès,
- audit réseau,
- supervision SIEM,
- monitoring sécurité.

---

# Technologies utilisées

- Laravel
- PHP
- MySQL
- Docker
- Nginx
- Nmap
- Wazuh SIEM

---

# Fonctionnalités sécurité

## Dockerisation
- Isolation des services applicatifs.
- Séparation Nginx / Laravel / MySQL.

## Gestion des accès
- Authentification Laravel.
- Rôles et permissions.
- Protection des routes sensibles.

## Audit réseau
- Scan des ports.
- Détection des services.
- Analyse réseau avec Nmap.

## Supervision SIEM
- Déploiement Wazuh.
- Monitoring des événements.
- Threat Hunting.
- Supervision endpoint Windows.

---

# Architecture

Le projet repose sur une architecture conteneurisée composée de :
- Nginx reverse proxy
- Application Laravel
- Base de données MySQL
- SIEM Wazuh

---

# Tests de sécurité réalisés

## Nmap
- Scan des ports ouverts.
- Détection des services actifs.
- Analyse avancée réseau.

## Wazuh
- Supervision des événements système.
- Monitoring endpoint Windows.
- Détection des activités système.

## OpenVAS
- Tentative de déploiement d’un scanner de vulnérabilités.

---

# Captures et documentation

Les captures d’écran et documents techniques sont disponibles dans :
```text
docs/
```

---

# Auteur

Yahya Elkhal  
Master Expert en Cybersécurité
