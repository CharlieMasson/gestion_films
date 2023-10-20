<div class="container p-2 mx-auto sm:p-4 dark:text-gray-100">
    <div class="text-sm text-green-600">
        <?= SessionManager::didUserJustLogIn() ? "Bonjour, ".$_SESSION['username']." !" : "" ?>
    </div>
	<h2 class="mb-4 text-2xl font-semibold leadi">Dashboard</h2>
	<div class="overflow-x-auto">
		<table class="w-full p-6 text-xs text-left whitespace-nowrap">
			<colgroup>
				<col>
				<col>
				<col>
				<col>
				<col>
				<col>
                <col>
				<col>
			</colgroup>
            <thead>
				<tr class="dark:bg-gray-700">
					<th class="p-3">Nom</th>
					<th class="p-3">Réalisateur</th>
					<th class="p-3">Genre</th>
					<th class="p-3">Scénariste</th>
					<th class="p-3">Société de production</th>
					<th class="p-3">Date de Sortie</th>
					<th class="p-3">Actions</th>
				</tr>
            </thead>
			<tbody class="border-b dark:bg-gray-900 dark:border-gray-700">
                <?php foreach($films as $film): ?>
                    <tr>
                        <td class="px-3 py-2">
                            <p><?= $film->getName() ?></p>
                        </td>
                        <td class="px-3 py-2">
                            <p><?= $film->getDirector() ?></p>
                        </td>
                        <td class="px-3 py-2">
                            <p><?= $film->getType() ?></p>
                        </td>
                        <td class="px-3 py-2">
                            <p><?= $film->getScriptWriter() ?></p>
                        </td>
                        <td class="px-3 py-2">
                            <p><?= $film->getProductionCompany() ?></p>
                        </td>
                        <td class="px-3 py-2">
                            <p><?= $film->getReleaseYear() ?></p>
                        </td>
                        <td class="px-3 py-2">
                            <p><a href="./Modify/<?= $film->getSlug() ?>">Afficher/Modifier le film</a></p>
                            <p><a href="./Delete/<?= $film->getSlug() ?>">Supprimer le film</a></p>
                        </td>
                    </tr>
                    <?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>