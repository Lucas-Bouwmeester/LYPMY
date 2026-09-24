const namefield = document.getElementById('namefield')

const listobj = document.getElementById('list')
const list = []
let target = ''

const add = (name) => {
	list.push(name)
	const li = document.createElement('li')
	li.innerHTML = name
	listobj.appendChild(li)

	namefield.value = list.join('§')
}