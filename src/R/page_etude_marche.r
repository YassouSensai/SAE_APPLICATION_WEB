# Chargement des bibliothèques
library(shiny)
library(shinydashboard)
library(plotly)

# Chargement des données des fichiers csv pour l'étude de marché (données fictives)
utilisateurs <- read.csv("donnees/etude_utilisateurs.csv")
tickets <- read.csv("donnees/etude_tickets.csv")

# Récupération des données statistiques 
nombre_profs <- nrow(subset(utilisateurs, type_util == "Professeur"))
nombre_eleves <- nrow(subset(utilisateurs, type_util == "Utilisateur"))

# Calculer la répartition entre élèves et professeurs
repartition_utilisateurs <- data.frame(Type = c("Professeurs", "Élèves"),
                                       Nombre = c(nombre_profs, nombre_eleves))

# Créer le diagramme camembert
repartition_camembert <- plot_ly(repartition_utilisateurs, labels = ~Type, values = ~Nombre, 
                                 type = "pie", marker = list(colors = c("blue", "orange")),
                                 text = ~paste("Type: ", Type))


nuage_points_ages <- plot_ly(utilisateurs, x = ~age, type = "scatter", mode = "markers", 
                             marker = list(color = 'rgba(255, 100, 102, 0.7)', size = 10),
                             text = ~paste("Utilisateur: ", type_util))

repartition_ville <- plot_ly(utilisateurs, labels = ~ville, type = "pie", 
                             marker = list(colors = rainbow(length(unique(utilisateurs$ville)))),
                             text = ~paste("Ville: ", ville))


# Définir l'interface utilisateur
ui <- fluidPage(
  titlePanel("Études de marché"),
  sidebarLayout(
    sidebarPanel(
      selectInput("vue", "Choisir une vue", choices = c("Données brutes", "Statistiques")),
      conditionalPanel(
        condition = "input.vue == 'Données brutes'",
        selectInput("etude", "Choisir une étude", choices = c("Utilisateurs", "Tickets"))
      )
    ),
    mainPanel(
      uiOutput("contenu")
    )
  )
)

# Définir le serveur
server <- function(input, output) {
  
  output$contenu <- renderUI({
    if (input$vue == "Données brutes") {
      if (input$etude == "Utilisateurs") {
        return(tableOutput("table_utilisateurs"))
      } else if (input$etude == "Tickets") {
        return(tableOutput("table_tickets"))
      }
    } else if (input$vue == "Statistiques") {
      return(
        tabsetPanel(
          tabPanel("Répartition entre Professeurs et Élèves", 
                   plotlyOutput("repartition_utilisateurs", height = 400)),
          tabPanel("Nuage de points pour les âges", 
                   plotlyOutput("nuage_points_ages", height = 400)),
          tabPanel("Répartition en camembert par ville", 
                   plotlyOutput("repartition_ville", height = 400))
        )
      )
    }
  })
  
  output$table_utilisateurs <- renderTable({
    if (input$etude == "Utilisateurs") {
      return(utilisateurs)
    }
  }, caption = "Tableau des Utilisateurs")
  
  output$table_tickets <- renderTable({
    if (input$etude == "Tickets") {
      return(tickets)
    }
  }, caption = "Tableau des Tickets")
  
  output$nuage_points_ages <- renderPlotly({
    nuage_points_ages %>%
      layout(title = "Nuage de points pour les âges des utilisateurs", margin = list(l = 50, r = 50, b = 50, t = 50))
  })
  
  output$repartition_ville <- renderPlotly({
    repartition_ville %>%
      layout(title = "Répartition en camembert par ville des utilisateurs", margin = list(l = 50, r = 50, b = 50, t = 50))
  })
  
  output$repartition_utilisateurs <- renderPlotly({
    repartition_camembert %>%
      layout(title = "Répartition entre Professeurs et Élèves", margin = list(l = 50, r = 50, b = 50, t = 50))
  })
}

# Lancer l'application Shiny
shinyApp(ui, server)
