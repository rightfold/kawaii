{ stdenv, php, phpPackages, psalm, sassc }:
stdenv.mkDerivation {
    name = "kawaii";
    src = ./.;
    buildInputs = [
        php
        phpPackages.composer
        psalm
        sassc
    ];
    buildPhase = ''
        composer dump-autoload
        psalm
        mkdir 'client-output'
        cp 'client/background.jpg' 'client-output'
        sassc -p '10' 'client/kawaii.scss' 'client-output/kawaii.css'
    '';
    installPhase = ''
        mkdir "$out"
        cp 'boot/index.php' "$out"
        cp -R 'src' "$out"
        cp -R 'vendor' "$out"
        cp -R 'client-output' "$out/client"
    '';
}
