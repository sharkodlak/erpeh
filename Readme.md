Chybná dokumentace API

V popisu API https://docs.recruitis.io/api/#tag/Jobs/paths/~1jobs/get
je u odpovědi položka closed_duration označena jako integer. Měla by být integer or null.

Položka internal_note vypadá chybně nastavená, protože v odpovědi je pojmenována "internal_note|string".

Položka stats má být object or null.
Položka automations má být array of objects or null.
Položka education je object a ne pole objektů.
Položka employment je object a ne pole objektů.
Položka salary má být object or null.