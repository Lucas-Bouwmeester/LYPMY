// Speedrun chat 12 minutes + backend T_T

const send = document.getElementById('sendchat')
const chat = document.getElementById('chat')

const getchat = async (msg='§') => {
	let stream = await fetch('./db/grouphandle.php?chat=' + msg)
	stream = await stream.text()

	chat.innerHTML = stream.replaceAll('§§', '<br>').replaceAll('§§', '<br>').replaceAll('§', ': ')
}; getchat(); setInterval(getchat, 1000)

const sendchat = () => {
	if (!send.value) { return }
	getchat(send.value)
	send.value = ''
}