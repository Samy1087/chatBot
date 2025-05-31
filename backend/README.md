# PROJET-MACHINE-LEARNING
Vente Immobilier 🏡

Introduction

Ce projet est un dashboard interactif pour l'analyse des données immobilières de Melbourne. Il permet aux utilisateurs de charger un fichier CSV contenant des données immobilières, de visualiser ces données, et d'effectuer des analyses avancées ainsi que des prédictions de prix.

Fonctionnalités

Chargement de Données : Téléchargez un fichier CSV contenant des données immobilières. Le dashboard détecte automatiquement le séparateur (virgule, point-virgule, tabulation).
Nettoyage des Données : Suppression des valeurs manquantes et des doublons, conversion des types de données, et encodage des variables catégoriques.
Visualisations : Distribution des prix, carte des biens immobiliers, ventes par nombre de pièces, et heatmap des corrélations.
Analyse Avancée : Analyse des facteurs influents sur le prix des biens immobiliers.
Prédiction : Prédiction du prix immobilier en fonction des caractéristiques saisies par l'utilisateur.
Installation
Pour exécuter ce dashboard, vous devez avoir Python installé sur votre machine. Suivez les étapes suivantes :

Cloner le dépôt :

git clone https://github.com/votre-utilisateur/votre-depot.git cd votre-depot Créer un environnement virtuel :

python -m venv env source env/bin/activate  # Sur Windows, utilisez env\Scripts\activate Installer les dépendances :

pip install -r requirements.txt Exécuter le dashboard :

streamlit run votre_script.py Utilisation Chargement de Données :

Téléchargez votre fichier CSV contenant les données immobilières. Le dashboard affiche un aperçu des données chargées. Exploration des Données :

Sélectionnez les colonnes à afficher. Utilisez les filtres interactifs pour explorer les données en fonction du prix, de l'année de construction, et du type de bien. Visualisations :

Explorez la distribution des prix, la carte des biens immobiliers, et les ventes par nombre de pièces. Visualisez la heatmap des corrélations pour comprendre les relations entre les variables. Analyse Avancée :

Analysez les facteurs influents sur le prix des biens immobiliers. Prédiction :

Saisissez les caractéristiques d'une propriété (surface, année de construction, nombre de pièces) pour obtenir une prédiction du prix. Personnalisation Vous pouvez personnaliser le dashboard en modifiant le code source. Par exemple, vous pouvez ajouter de nouvelles visualisations, modifier les filtres, ou ajuster les modèles de prédiction.

Contributions

Les contributions sont les bienvenues ! Si vous souhaitez contribuer à ce projet, veuillez suivre les étapes suivantes :

Forkez le dépôt.
Créez une branche pour votre fonctionnalité (git checkout -b feature/nouvelle-fonctionnalite).
Commitez vos modifications (git commit -m 'Ajout d'une nouvelle fonctionnalité').
Poussez vers la branche (git push origin feature/nouvelle-fonctionnalite).
Ouvrez une Pull Request.
