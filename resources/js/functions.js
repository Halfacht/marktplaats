export function titleCase(string) {
	if (!(typeof string === 'string' || string instanceof String)) {		
        return '';
    }

	return string
		.toLowerCase()
		.replace('_', ' ')
		.split(' ')
		.map(word => capitalizeFirstLetter(word))
		.join(' ');
}

export function capitalizeFirstLetter(string) {
    if (!(typeof string === 'string' || string instanceof String)) {		
        return '';
    }
	
    return string.charAt(0).toUpperCase() + string.slice(1);
}
