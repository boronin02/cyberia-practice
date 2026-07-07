import styles from "./Logo.module.scss";
import Link from "next/link";
import { ROUTES } from "@/shared/index";

import { LogoIcon } from "@/shared/assets/icons";

export const Logo = () => {
  return (
    <div className={styles.logo}>
      <Link href={ROUTES.HOME} className={styles.logoLink}>
        <LogoIcon width={173} height={31} />
      </Link>
    </div>
  );
};
