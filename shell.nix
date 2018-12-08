{ nixpkgs ? import ./nix/nixpkgs.nix {} }:
{
    database = nixpkgs.sqitchPg;
}
