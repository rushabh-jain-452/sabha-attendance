function formatDate(dt) {
    alert('Date is ' + dt);
}

function getFormattedDate() {
    const dt = new Date();
    const str = dt.toDateString();

    //  0123456789
    // 'Sat Jan 20 2024'
    const day = str.substring(8,10);
    const month = str.substring(4,7);
    const year = str.substring(11,15);

    // 20 Jan 2024 at 09:29:00
    return day + ' ' + month + ' ' + year + ' at ' + dt.toLocaleTimeString();

    // 20 Jan 2024 at 4:20:18 PM
}
