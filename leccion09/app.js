window.setInterval(function () {
    refreshStats();
}, 2000);

function refreshStats() {
    fetchData('/ajax/getTotalCustomers.php', 'panel-customers');
    fetchData('/ajax/getTotalSubscriptions.php', 'panel-subscriptions');
    fetchData('/ajax/getTotalAmount.php', 'panel-amount');
}

function fetchData(url, element) {
    var span = document.getElementById(element);
    fetch(url)
        .then(function(result) {
            return result.json();
        })
        .then(function(json) {
            span.textContent = json;
        }).catch(function(error) {
            span.textContent = error.message;
        });
}
