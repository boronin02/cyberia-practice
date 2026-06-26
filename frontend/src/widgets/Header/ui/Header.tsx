import styles from "./Header.module.css";
import { Logo } from "./Logo";
import { Nav } from "./Nav";
import { Social } from "./Social";
import { useState, useEffect } from "react";

export const Header = () => {
  const [isDark, setIsDark] = useState(false);
  console.log(isDark);
  useEffect(() => {
    const handleScroll = () => {
      setIsDark(window.scrollY > 60);
    };

    window.addEventListener("scroll", handleScroll);

    return () => {
      window.removeEventListener("scroll", handleScroll);
    };
  });
  console.log(isDark);
  return (
    <header className={`${styles.header} ${isDark && styles.dark}`}>
      <Logo isDark={isDark} />
      <Nav />
      <Social isDark={isDark} />
    </header>
  );
};
