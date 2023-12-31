

# Charger les données
utilisateurs <- read.csv("etude_utilisateurs.csv")
tickets <- read.csv("etude_tickets.csv")

# Définir l'interface utilisateur
ui <- fluidPage(
  titlePanel("Études de marché"),
  sidebarLayout(
    sidebarPanel(
      selectInput("etude", "Choisir une étude", choices = c("Utilisateurs", "Tickets"))
    ),
    mainPanel(
      tableOutput("table")
    )
  )
)

# Définir le serveur
server <- function(input, output) {
  output$table <- renderTable({
    if (input$etude == "Utilisateurs") {
      return(utilisateurs)
    } else if (input$etude == "Tickets") {
      return(tickets)
    }
  })
}

# Lancer l'application Shiny
shinyApp(ui, server)
