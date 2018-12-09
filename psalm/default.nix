{ stdenv, fetchurl, php }:
stdenv.mkDerivation {
    name = "psalm";
    src = fetchurl {
        url = https://github.com/vimeo/psalm/releases/download/3.0.2/psalm.phar;
        sha256 = "0am5pjrnxbr5cpjb5555dq9z2b0szc1ps7srqdnfpqz49xshcl50";
    };
    buildInputs = [
        php
    ];
    unpackPhase = ''
        cp "$src" 'psalm.phar'
    '';
    installPhase = ''
        mkdir -p "$out/lib"
        mv 'psalm.phar' "$out/lib/psalm.phar"

        mkdir -p "$out/bin"
        (
            echo '#!/bin/sh'
            echo 'export PATH="$PATH:${php}/bin"'
            echo "exec php '$out/lib/psalm.phar' "'"$@"'
        ) >> "$out/bin/psalm"
        chmod +x "$out/bin/psalm"
    '';
}
