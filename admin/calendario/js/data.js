var events = {
	'11-21-2016' : [{content: 'Great American Smokeout', url: 'http://www.wincalendar.com/Great-American-Smokeout', allDay: true}],
	'11-11-2016' : [{content: 'Remembrance Day (Canada)', url: 'http://www.wincalendar.com/Remembrance-Day', allDay: true}], 
	'12-25-2016' : [{content: 'Natal', repeat: 'YEARLY', allDay: true, endDate: '12-25-2100'}],
	'01-22-2018' : [{content: 'Curso de Direito Eletrônico<br> Período acesso ao curso: <br> 22/01 a 23/03', repeat: 'YEARLY', allDay: true, endDate: '03-23-2018'}],

},
t = new Date(),
//Creation of today event
today = ((t.getMonth() + 1) < 10 ? '0' + (t.getMonth() + 1) : (t.getMonth() + 1)) + '-' + (t.getDate() < 10 ? '0' + t.getDate() : t.getDate()) + '-' +t.getFullYear();
events[today] = [{content: 'HOJE', allDay: true}];
