<div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
	<div class="relative py-3 sm:max-w-xl sm:mx-auto">
		<div
			class="absolute inset-0 bg-gradient-to-r from-blue-300 to-blue-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl">
		</div>
		<div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
			<div class="max-w-md mx-auto">
				<div>
					<h1 class="text-2xl font-semibold"><?= $film->getName() ?></h1>
				</div>
				<div class="divide-y divide-gray-200">
                    <div class="text-sm text-red-600">
                        <?php foreach($messages as $message): ?>
                            <?=  $message ?>
                        <?php endforeach ?>
                    </div>
                    <form class="space-y-6" method="POST">
                        <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                        <div class="relative">
                            <input autocomplete="off" id="name" name="name" type="text" maxlength="50" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Nom" value="<?= isset($sentForm['name']) ? $sentForm['name'] : $film->getName() ?>">
                            <label for="name" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Nom</label>
                        </div>
                        <div class="relative">
                            <input autocomplete="off" id="director" name="director" type="text" maxlength="50" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Réalisateur" value="<?= isset($sentForm['director']) ? $sentForm['director'] : $film->getDirector() ?>">
                            <label for="director" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Réalisateur</label>
                        </div>
                        <div class="relative">
                            <input autocomplete="off" id="type" name="type" type="text" maxlength="50" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Genre" value="<?= isset($sentForm['type']) ? $sentForm['type'] : $film->getType() ?>">
                            <label for="type" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Genre</label>
                        </div>
                        <div class="relative">
                            <input autocomplete="off" id="scriptwriter" name="scriptwriter" type="text" maxlength="50" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Scénariste" value="<?= isset($sentForm['scriptwriter']) ? $sentForm['scriptwriter'] : $film->getScriptwriter() ?>">
                            <label for="scriptwriter" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Scénariste</label>
                        </div>
                        <div class="relative">
                            <input autocomplete="off" id="production_company" name="production_company" type="text" maxlength="50" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Société de Production" value="<?= isset($sentForm['production_company']) ? $sentForm['production_company'] : $film->getProductionCompany() ?>">
                            <label for="production_company" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Société de Production</label> 
                        </div>
                        <div class="relative">
                            <input autocomplete="off" id="release_year" name="release_year" type="number" maxlength="50" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Année de Sortie" value="<?= isset($sentForm['release_year']) ? $sentForm['release_year'] : $film->getReleaseYear() ?>">
                            <label for="release_year" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Année de Sortie</label>
                        </div>
                        <div class="relative">
                            <textarea autocomplete="off" id="synopsis" name="synopsis" maxlength="250" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Synopsis"><?= isset($sentForm['synopsis']) ? $sentForm['synopsis'] : $film->getSynopsis() ?></textarea>
                            <label for="synopsis" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Synopsis</label>
                        </div>
                        <div class="relative">
                            <button type="submit" name="submit" class="bg-blue-500 text-white rounded-md px-2 py-1">Modifier</button>
                            <button class="bg-gray-500 text-white rounded-md px-2 py-1"><a href="../Dashboard">Annuler</a></button>
                        </div>
                    </form>
				</div>
			</div>
		</div>
	</div>
</div>
