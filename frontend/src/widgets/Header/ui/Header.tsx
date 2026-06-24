import styles from "./Header.module.css";
import Image from "next/image";
import { Logo } from "./Logo";
import { Nav } from "./Nav";
import { Social } from "./Social";

export const Header = () => {
  return (
    <header className={styles.header}>
      <Logo />
      {/* NAVIGATION */}
      <Nav />
      {/* SOCIAL */}
      <Social />
    </header>
  );
};
