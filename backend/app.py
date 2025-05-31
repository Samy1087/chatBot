import streamlit as st
import numpy as np
import pandas as pd
import plotly.express as px
import seaborn as sns
import matplotlib.pyplot as plt
from sklearn.linear_model import LinearRegression
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import LabelEncoder
# Personnalisation CSS
st.markdown(
    """
    <style>
        .main { background-color: #ffff00; } /* Jaune */
        .stApp { background-color: #ffff00; } /* Jaune */
        .stTitle { color: #2E86C1; text-align: center; }
        .stSubheader { color: #1F618D; }
        .dataframe { background-color: white; border-radius: 10px; padding: 10px; box-shadow: 2px 2px 5px rgba(0,0,0,0.1); }
    </style>
    """,
    unsafe_allow_html=True
)
# Titre et introduction
st.title("Votre Analyse de vente Immobiliere 🏡")
st.write("Analyse des données immobilières de Melbourne")

# Fonction pour charger les données avec détection automatique du séparateur
def load_data(uploaded_file):
    try:
        # Si un fichier est téléchargé, on le lit
        if uploaded_file is not None:
            # Détecter automatiquement le séparateur en analysant les premières lignes
            sample_data = uploaded_file.getvalue().decode("utf-8")
            delimiter = ","  # Valeur par défaut

            # Vérification du séparateur en fonction du contenu
            if ";" in sample_data:
                delimiter = ";"
            elif "\t" in sample_data:
                delimiter = "\t"
            
            # Relecture du CSV avec le bon séparateur
            df = pd.read_csv(uploaded_file, delimiter=delimiter, encoding="utf-8", on_bad_lines="skip", low_memory=False)
            return df
        else:
            st.warning("Veuillez télécharger un fichier CSV.")
            return pd.DataFrame()

    except Exception as e:
        st.error(f"Erreur lors du chargement des données : {e}")
        return pd.DataFrame()
# Interface utilisateur pour télécharger un fichier
st.title("Chargement de données")
uploaded_file = st.file_uploader("Téléchargez votre fichier CSV", type=["csv"])

# Charger et afficher les données si le fichier est téléchargé
df = load_data(uploaded_file)

# Affichage du dataset si le fichier est bien chargé
if not df.empty:
    st.subheader("Aperçu des Données Chargées")
    st.dataframe(df, use_container_width=True)  # Affiche le DataFrame dans un format propre

else:
    st.warning("Aucune donnée chargée. Vérifiez votre fichier CSV.")

# Si les données sont chargées, appliquer les traitements suivants
if not df.empty and df.shape[0] > 0:
    # Nettoyage des données
    df.dropna(subset=["Price"], inplace=True)
    df.drop_duplicates(inplace=True)

    # Vérification des valeurs numériques
    df = df[df["Price"].apply(lambda x: str(x).replace(',', '').replace('.', '').isdigit())]
    df["Price"] = df["Price"].astype(float)
    df.rename(columns={"Lattitude": "latitude", "Longtitude": "longitude"}, inplace=True)
    colonnes_utiles = ["Price", "latitude", "longitude", "BuildingArea", "YearBuilt", "Rooms", "Type"]
    df = df[colonnes_utiles].dropna()

    # Encodage des variables catégoriques
    df["Type"] = LabelEncoder().fit_transform(df["Type"])

    # Organisation avec des onglets
    tab1, tab2, tab3, tab4 = st.tabs(["📊 Données", "📉 Visualisations", "📈 Analyse avancée", "🔮 Prédiction"])

# Onglet 1 : Données
    with tab1:
        st.subheader("Chargement du Dataset 📊")
        st.dataframe(df, use_container_width=True)

        st.subheader("Sélection des Colonnes 🔎")
        colonnes_selectionnees = st.multiselect("Choisissez les colonnes à afficher", df.columns, default=df.columns)
        st.dataframe(df[colonnes_selectionnees], use_container_width=True)

        st.subheader("Statistiques Descriptives")
        st.write(df.describe())

        # Filtres interactifs
        if not df["Price"].isna().all():
            prix_min, prix_max = int(df["Price"].min()), int(df["Price"].max())
            prix_selection = st.slider("Filtrer par Prix", prix_min, prix_max, (prix_min, prix_max))
            df_filtered = df[(df["Price"] >= prix_selection[0]) & (df["Price"] <= prix_selection[1])]

            # Ajout de filtres supplémentaires
            annee_min, annee_max = int(df["YearBuilt"].min()), int(df["YearBuilt"].max())
            annee_selection = st.slider("Filtrer par Année de Construction", annee_min, annee_max, (annee_min, annee_max))
            df_filtered = df_filtered[(df_filtered["YearBuilt"] >= annee_selection[0]) & (df_filtered["YearBuilt"] <= annee_selection[1])]

            type_selection = st.multiselect("Filtrer par Type", options=df["Type"].unique(), default=df["Type"].unique())
            df_filtered = df_filtered[df_filtered["Type"].isin(type_selection)]

            st.dataframe(df_filtered, use_container_width=True)
            # Onglet 2 : Visualisations
    with tab2:
        st.subheader("Distribution des Prix 💰")
        fig = px.histogram(df_filtered, x="Price", nbins=50, title="Distribution des prix des maisons")
        st.plotly_chart(fig, use_container_width=True)

        st.subheader("Carte des Biens Immobiliers 📍")
        st.map(df_filtered[["latitude", "longitude"]])

        st.subheader("Carte de Densité des Ventes")
        st.map(df_filtered[["latitude", "longitude"]], zoom=10, use_container_width=True)

        st.subheader("Ventes par Nombre de Pièces")
        fig_pieces = px.bar(df_filtered, x="Rooms", y="Price", title="Prix moyen par nombre de pièces", barmode="group")
        st.plotly_chart(fig_pieces, use_container_width=True)

        st.subheader("Heatmap des Corrélations 📊")
        plt.figure(figsize=(8, 6))
        sns.heatmap(df_filtered.corr(numeric_only=True), annot=True, cmap="coolwarm", fmt=".2f")
        st.pyplot(plt)

  # Onglet 3 : Analyse avancée
    with tab3:
        st.subheader("Analyse des Facteurs Influents")
        correlation_matrix = df_filtered.corr(numeric_only=True)
        st.write(correlation_matrix["Price"].sort_values(ascending=False))
        # Onglet 4 : Prédiction
    with tab4:
        st.subheader("Prédiction du Prix Immobilier")
        features = ["BuildingArea", "YearBuilt", "Rooms"]
        df_filtered = df_filtered.dropna(subset=features)  # Suppression des valeurs manquantes pour la régression
        X = df_filtered[features]
        y = df_filtered["Price"]

        X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)
        model = LinearRegression()
        model.fit(X_train, y_train)

        st.write("Voyez le modele de prediction entraîné avec succès !")

        # Ajout d'une section pour prédire le prix en fonction des caractéristiques saisies par l'utilisateur
        st.subheader("Prédire le Prix d'une Propriété")
        building_area = st.number_input("Surface (BuildingArea)", min_value=0, value=100)
        year_built = st.number_input("Année de Construction (YearBuilt)", min_value=1800, max_value=2023, value=2000)
        rooms = st.number_input("Nombre de Pièces (Rooms)", min_value=1, value=3)

        prediction = model.predict([[building_area, year_built, rooms]])
        st.write(f"Le prix prédit pour la propriété est : {prediction[0]:.2f} $")
