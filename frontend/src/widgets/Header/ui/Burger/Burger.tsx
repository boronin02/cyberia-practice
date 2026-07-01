import styles from "./Burger.module.scss";
import Link from "next/link";
import Image from "next/image";
import { tgLogo, burger } from "@/shared/assets/images/header";

interface BurgerProps {
  toggleMenu: () => void;
}

export const Burger = ({ toggleMenu }: BurgerProps) => {
  return (
    <div className={styles.burger}>
      <Link href="/" className={styles.burger}>
        <Image src={tgLogo} alt="tgLogo" />
      </Link>
      <Image src={burger} alt="burger" width={24} onClick={toggleMenu} />
    </div>
  );
};
