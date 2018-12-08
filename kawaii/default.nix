{ stdenv, php, phpPackages, psalm }:
stdenv.mkDerivation {
    name = "kawaii";
    src = ./.;
    buildInputs = [
        php
        phpPackages.composer
        psalm
    ];
    buildPhase = ''
        composer dump-autoload
        psalm
    '';
    installPhase = ''
        mkdir "$out"
        cp 'boot/index.php' "$out"
        cp -R 'src' "$out"
        cp -R 'vendor' "$out"
    '';
}
