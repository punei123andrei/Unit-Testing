// Import jQuery
import $ from 'jquery';

import PrintHtml from './PrintHtml';

class Request {

  constructor() {
    this.printHtmlInstance = new PrintHtml(); 
    this.eventHandlers();
  }

  sendData(action, userId) {
    const data = {
      action: action,
      userId: userId
    };
    $.ajax({
      url: ajax_obj.ajaxurl,
      method: 'POST',
      data: data,
      success: (response) => {
        this.printHtmlInstance.printHtmlTable(response);
      },
      error: function (error) {
        console.error('Error:', error);
      }
    });
  }

  eventHandlers() {
    $(document).ready(() => {
      this.sendData('inpsyde_get_users');
    });
  }

}

export default Request;