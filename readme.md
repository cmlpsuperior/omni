//install PDF:

	1. ejecutamos en el CMD: composer require barryvdh/laravel-dompdf
	2. agregamos en el config/app el provider y el aliases:
		
		Barryvdh\DomPDF\ServiceProvider::class,
		
		'PDF' => Barryvdh\DomPDF\Facade::class,