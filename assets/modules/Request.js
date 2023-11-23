// Import jQuery
import $ from 'jquery';

class Request {
  constructor() {
    // ... (your constructor code)
    this.eventHandlers();
  }

  appendHtml(response) {
    // ... (your appendHtml code)
  }

  sendData(option) {
    const data = {
      action: 'get_user_list',
      // Add other data if needed
    };

    // Use jQuery.ajax
    $.ajax({
      url: ajax_obj.ajaxurl,
      method: 'POST',
      data: data,
      success: (response) => {
        console.log(response);
        // this.appendHtml(response);
      },
      error: function (error) {
        console.error('Error:', error);
      }
    });
  }

  eventHandlers() {
    // Trigger the AJAX call on document ready using jQuery
    $( document ).ready(function() {
      console.log( "ready!" );
  });
    // Uncomment the following lines if you need other event handlers
    // this.loadMoreBtn.on('click', (e) => {
    //     e.preventDefault();
    //     ajax_obj.current_page++;
    //     this.sendData('load-more');
    // });
  }
}

export default Request;