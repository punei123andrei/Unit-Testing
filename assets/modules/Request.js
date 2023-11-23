import $ from "jquery"

class Request {
  constructor() {
    // this.addSearchHTML()
    // this.resultsDiv = $("#user_profile")
    // this.singleLink = $(".single-link")
    this.events()
  }

  events() {
    // this.singleLink.on("click", this.getResults.bind(this))
    // $(document).on("keydown", this.keyPressDispatcher.bind(this))
    console.log('HermanFrau');
  }

  // 3. methods (function, action...)
//   typingLogic() {
//     if (this.searchField.val() != this.previousValue) {
//       clearTimeout(this.typingTimer)

//       if (this.searchField.val()) {
//         if (!this.isSpinnerVisible) {
//           this.resultsDiv.html('<div class="spinner-loader"></div>')
//           this.isSpinnerVisible = true
//         }
//         this.typingTimer = setTimeout(this.getResults.bind(this), 750)
//       } else {
//         this.resultsDiv.html("")
//         this.isSpinnerVisible = false
//       }
//     }

//     this.previousValue = this.searchField.val()
//   }

//   getResults() {
//     $.when($.getJSON(universityData.root_url + "/wp-json/wp/v2/posts?search=" + this.searchField.val()), $.getJSON(universityData.root_url + "/wp-json/wp/v2/pages?search=" + this.searchField.val())).then(
//       (posts, pages) => {
//         var combinedResults = posts[0].concat(pages[0])
//         this.resultsDiv.html(`
//         <h2 class="search-overlay__section-title">General Information</h2>
//         ${combinedResults.length ? '<ul class="link-list min-list">' : "<p>No general information matches that search.</p>"}
//           ${combinedResults.map(item => `<li><a href="${item.link}">${item.title.rendered}</a></li>`).join("")}
//         ${combinedResults.length ? "</ul>" : ""}
//       `)
//         this.isSpinnerVisible = false
//       },
//       () => {
//         this.resultsDiv.html("<p>Unexpected error; please try again.</p>")
//       }
//     )
//   }

//   userProfile() {
//     $("body").append(`
//       <div class="search-overlay">
//         <div class="search-overlay__top">
//           <div class="container">
//             <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
//             <input type="text" class="search-term" placeholder="What are you looking for?" id="search-term">
//             <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
//           </div>
//         </div>
        
//         <div class="container">
//           <div id="search-overlay__results"></div>
//         </div>

//       </div>
//     `)
//   }
}

export default Request
