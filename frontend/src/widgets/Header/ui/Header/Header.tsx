import styles from "./Header.module.scss";
import { Logo, Nav, Social } from "../index";
import { useState, useEffect } from "react";
import clsx from "clsx";
import { throttle } from "@/shared/lib/throttle";
import { HeaderTheme } from "../../lib/HeaderTheme";
import { HeaderContext } from "../../lib/HeaderContext";
import { Burger } from "../Burger";
import { MobileMenu } from "../MobileMenu";

const HEADER_DARK_MODE_SCROLL_Y = 60;

export const Header = () => {
  const [theme, setTheme] = useState(HeaderTheme.Light);
  const [isOpen, setIsOpen] = useState(false);

  useEffect(() => {
    const handleScroll = throttle(() => {
      if (window.scrollY > HEADER_DARK_MODE_SCROLL_Y) {
        setTheme(HeaderTheme.Dark);
      } else {
        setTheme(HeaderTheme.Light);
      }
    }, 100);

    window.addEventListener("scroll", handleScroll);

    return () => {
      window.removeEventListener("scroll", handleScroll);
    };
  }, []);

  const toggleMenu = () => setIsOpen(true);
  const closeMenu = () => setIsOpen(false);

  return (
    <HeaderContext.Provider value={theme}>
      <header
        className={clsx(styles.header, {
          [styles.dark]: theme === HeaderTheme.Dark,
        })}
      >
        <Logo />
        <Nav />
        <Social />
        <Burger toggleMenu={toggleMenu} />
        <MobileMenu isOpen={isOpen} closeMenu={closeMenu} />
      </header>
    </HeaderContext.Provider>
  );
};
