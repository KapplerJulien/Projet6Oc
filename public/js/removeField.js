window.onload = () => {
    // Gestion des liens "Supprimer"
    let links = document.querySelectorAll("[data-delete]")

    // Boucler sur links
    for(link of links){
        // On écoute le clic
        link.addEventListener("click", function(e){
            // On empêche la navigation 
            e.preventDefault()

            // On demande confirmation
            if(confirm("Êtes vous sûr de vouloir supprimer ?")){
                // On envoie une requête Ajax vers le href du lien avec la method "DELETE"
                fetch(this.getAttribute("href"), {
                    method: "DELETE",
                    headers: {
                        "X-Requested-With": "XMLHttpRequest",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({"_token": this.dataset.token})
                }).then(
                    // On récupère la réponse en JSON 
                    response => response.json()
                ).then(data => {
                    if(data.success)
                        this.parentElement.parentElement.parentElement.parentElement.parentElement.remove()
                    else
                        alert(data.error)
                }).catch(e => alert(e))                
            }
        })
    }
}