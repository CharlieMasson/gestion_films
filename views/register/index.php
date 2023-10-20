<div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
	<div class="relative py-3 sm:max-w-xl sm:mx-auto">
		<div
			class="absolute inset-0 bg-gradient-to-r from-blue-300 to-blue-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl">
		</div>
		<div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
			<div class="max-w-md mx-auto">
				<div>
					<h1 class="text-2xl font-semibold">Créer un compte</h1>
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
                <input autocomplete="off" id="username" name="username" type="text" maxlength="50" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Pseudonyme" value="<?= isset($sentForm['username']) ? $sentForm['username'] : "" ?>">
                <label for="password" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Pseudonyme</label>
              </div>
              <div class="relative">
                <input autocomplete="off" id="email" name="email" type="email" maxlength="50" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Adresse Email" value="<?= isset($sentForm['email']) ? $sentForm['email'] : "" ?>">
                <label for="email" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Adresse Email</label>
              </div>
              <div class="relative">
                <input autocomplete="off" id="password" name="password" type="password" maxlength="50" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Mot de Passe">
                <label for="password" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Mot de Passe</label>
              </div>
              <div class="relative">
                <input autocomplete="off" id="passwordConf" name="passwordConf" type="password" maxlength="50" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Mot de Passe">
                <label for="passwordConf" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Confirmation du Mot de Passe</label>
              </div>
              <div class="text-xs text-gray-900"> 12 caractères, 1 minuscule, 1 majuscule, 1 caractère spéciale et un chiffre. </div>
              <div class="relative">
                <button type="submit" name="submit" class="bg-blue-500 text-white rounded-md px-2 py-1">S'inscrire</button>
              </div>
              <span class="text-sm text-neutral-400 text-center"> Vous avez déjà un compte? <a href="./Login" class="text-blue-400 hover:underline">Connectez vous</a></span>
            </div>
          </form>
				</div>
			</div>
		</div>
	</div>
</div>
