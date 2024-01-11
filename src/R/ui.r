# ui.r
library(shiny)
library(shinydashboard)
library(plotly)

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
