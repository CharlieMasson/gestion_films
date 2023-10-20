<div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
	<div class="relative py-3 sm:max-w-xl sm:mx-auto">
		<div
			class="absolute inset-0 bg-gradient-to-r from-blue-300 to-blue-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl">
		</div>
		<div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
			<div class="max-w-md mx-auto">
				<div>
					<h1 class="text-2xl font-semibold">Connexion</h1>
				</div>
				<div class="divide-y divide-gray-200">
                    <form class="space-y-6" method="POST">
                        <div class="text-sm text-red-600">
                            Voulez-vous vraiment supprimer le film <?= $film->getName() ?> ? 
                        </div>
                        <div class="relative">
                            <button type="submit" name="submit" class="bg-red-600 text-white rounded-md px-2 py-1">Supprimer</button>
                            <button class="bg-gray-500 text-white rounded-md px-2 py-1"><a href="../Dashboard">Annuler</a></button>
                        </div>
                    </form>
				</div>
			</div>
		</div>
	</div>
</div>