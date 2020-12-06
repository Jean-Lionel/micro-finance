
//swal.fire('bonjour tout le mode')

function _formatDate(given_date){
	const dte = new Date(given_date);

	return `Le ${ dte.getDate()}-${dte.getMonth() + 1}-${dte.getFullYear()} `
}



function _formatNumber(number){
	return new Intl.NumberFormat('de-DE').format(number)
}
