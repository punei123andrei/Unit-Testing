import $ from 'jquery';

class PrintHtml {

    constructor() {
        this.targetContainer = $('#inspyde-table');

        if (this.targetContainer.length === 0) {
            console.error('Target container does not exist. Program terminated.');
            return; // Terminate the program
        }
    }

    printHtmlTable(response) {
        const dataArray = JSON.parse(response);

        const tableRows = dataArray.map(item => `
          <tr>
            <td>${item.id}</td>
            <td>${item.name}</td>
            <td>${item.username}</td>
          </tr>
        `);

        const tableHtml = `
          <h2 class="search-overlay__section-title">General Information</h2>
          ${dataArray.length ? '<table class="your-table-class">' : "<p>No general information matches that search.</p>"}
            ${tableRows.join("")}
          ${dataArray.length ? "</table>" : ""}
        `;

        this.targetContainer.html(tableHtml);
    }

    printUserInfo(response) {

    }


}

export default PrintHtml;