{ pkgs }: {
  deps = [
    pkgs.php81
    pkgs.php81Extensions.sqlite3
    pkgs.php81Extensions.mbstring
    pkgs.php81Extensions.xml
    pkgs.php81Extensions.curl
    pkgs.php81Extensions.gd
    pkgs.php81Extensions.zip
    pkgs.php81Extensions.intl
    pkgs.sqlite
    pkgs.nodejs-18_x
    pkgs.nodePackages.typescript
    pkgs.yarn
  ];
} 