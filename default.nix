{ nixpkgs ? import ./nix/nixpkgs.nix {} }:
rec {
    kawaii = nixpkgs.callPackage ./kawaii { psalm = psalm; };
    psalm = nixpkgs.callPackage ./psalm {};
}
