createFormatDate = (original) => {
    let date = new Date(original);

    let day = String(date.getDate()).padStart(2, '0');
    let shortMonth = date.toLocaleString('en-US', {
        month: 'short'
    });
    let year = date.getFullYear();

    let formatted = `${day}-${shortMonth}-${year}`;

    return formatted
}