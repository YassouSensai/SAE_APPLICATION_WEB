# server.r
library(shiny)
library(shinydashboard)
library(plotly)
source("global.r")

# Définir le serveur
server <- function(input, output, session) {

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
