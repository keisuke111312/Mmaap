{ pkgs ? import (fetchTarball "https://github.com/NixOS/nixpkgs/archive/nixos-23.11.tar.gz") {} }:

pkgs.mkShell {
  buildInputs = [
    pkgs.php82
    pkgs.composer
    pkgs.nodejs_20
    pkgs.git
    pkgs.mysql
  ];
}
