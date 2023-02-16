window.onload = function() {
	// Get search form and table rows
	var searchForm = document.getElementsByTagName("form")[0];
	var tableRows = document.getElementsByClassName("row");

	// Add event listener to search form
	searchForm.addEventListener("submit", function(event) {
		event.preventDefault(); // prevent form submission
		var searchTerm = event.target.search.value.toLowerCase();

		// Loop through table rows and hide/show based on search term
		for (var i = 1; i < tableRows.length; i++) { // skip header row (index 0)
			var rowCells = tableRows[i].getElementsByClassName("cell");
			var rowText = rowCells[0].textContent.toLowerCase() + rowCells[1].textContent.toLowerCase() + rowCells[2].textContent.toLowerCase();
			if (rowText.indexOf(searchTerm) > -1) {
				tableRows[i].style.display = ""; // show row
			} else {
				tableRows[i].style.display = "none"; // hide row
			}
		}
	});
};
