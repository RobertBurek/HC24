const createSnow = () => {
	const snowflake = document.createElement('div');
	snowflake.classList.add('snowflake');
	let listSnowflakes = ['❆','✻','❅','❆','✵','✼','✵','❆','❄️'];
	snowflake.textContent = listSnowflakes[Math.floor(Math.random() * 8)];

	snowflake.style.left = Math.random() * (window.innerWidth - 40) + 'px';
	snowflake.style.animationDuration = Math.random() * 5 + 3 + 's';
	snowflake.style.opacity = Math.random();


	document.body.append(snowflake);

	setTimeout(() => {
		snowflake.remove();
	}, 8000);

}

setInterval(createSnow, 50);